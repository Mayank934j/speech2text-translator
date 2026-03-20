import sys
sys.stdout.reconfigure(encoding='utf-8')
import os
import speech_recognition as sr
from googletrans import Translator
from moviepy.video.io.VideoFileClip import VideoFileClip
from moviepy.audio.io.AudioFileClip import AudioFileClip
from pydub import AudioSegment
AudioSegment.converter = r"C:\Users\Win10\miniconda3\Library\bin\ffmpeg.exe"
import textwrap
from math import ceil
import asyncio
import edge_tts

async def generate_edge_audio(chunks, lang, output_audio_path):
    final_audio = AudioSegment.silent(duration=0)

    for idx, chunk in enumerate(chunks):
        try:
            temp_path = f"temp_edge_chunk_{idx}.mp3"
            communicate = edge_tts.Communicate(
                text=chunk,
                voice="hi-IN-MadhurNeural" if lang.startswith("hi") else "en-IN-NeerjaNeural",
                rate="-20%"
            )
            await communicate.save(temp_path)

            part = AudioSegment.from_file(temp_path)
            print(f"✅ Edge Chunk {idx} saved & loaded, duration: {len(part)}ms")
            final_audio += part + AudioSegment.silent(duration=800)
            os.remove(temp_path)

            print(f"✅ Edge Chunk {idx} saved & loaded, duration: {len(part)}ms")
        except Exception as e:
            print(f"❌ EdgeTTS Error in chunk {idx}: {e}")

    print(f"📦 Final audio total duration: {len(final_audio)} ms")
    # 🛑 Ye line bahut important hai
    final_audio.export(output_audio_path, format="wav")
    print(f"✅ Final exported audio path: {output_audio_path}")
    print(f"📏 Exported file size: {os.path.getsize(output_audio_path)} bytes")


def main():
    try:
        os.makedirs("outputs", exist_ok=True)

        if len(sys.argv) < 4:
            print("Error: Missing arguments. Usage: python process_audio.py <input_file> <source_lang> <target_lang>")
            sys.exit(1)

        input_file = sys.argv[1]
        source_lang = sys.argv[2]
        target_lang = sys.argv[3]

        if not os.path.exists(input_file):
            print(f"Error: Input file '{input_file}' not found")
            sys.exit(1)

        file_ext = os.path.splitext(input_file)[1].lower()
        audio_path = "temp_audio.wav"


        if file_ext in ['.mp4', '.mov', '.mkv', '.avi']:
            try:
                print("Extracting audio from video...")
                video = VideoFileClip(input_file)
                video.audio.write_audiofile(audio_path)
                video.close()
            except Exception as e:
                print(f"Error extracting audio from video: {str(e)}")
                sys.exit(1)
        elif file_ext in ['.mp3', '.wav', '.flac']:
            try:
                print("Processing audio file...")
                sound = AudioSegment.from_file(input_file)
                sound = sound.set_channels(1)
                sound = sound.set_frame_rate(16000)
                sound.export(audio_path, format="wav")

            except Exception as e:
                print(f"Error processing audio file: {str(e)}")
                sys.exit(1)
        else:
            print(f"Unsupported file format: {file_ext}")
            sys.exit(1)

        # ✅ Ab file ban chuki hai, ab karte hain mediainfo
        from pydub.utils import mediainfo
        info = mediainfo(audio_path)
        if 'duration' in info:
            print(f"⏱️ Duration from mediainfo: {info['duration']} seconds")
        else:
            print("❌ 'duration' not found in mediainfo output. File may be empty or invalid.")
            sys.exit(1)

        r = sr.Recognizer()
        try:
            print("Recognizing speech in chunks...")


            sound = AudioSegment.from_file(audio_path)
            duration_sec = sound.duration_seconds
            print(f"🎵 Original Audio Duration: {duration_sec} seconds")
            chunk_size_ms = 10 * 1000  # 10 sec per chunk
            full_text = ""

            recognized_chunks = 0
            for i in range(0, ceil(duration_sec / 10)):
                # recognize_google() block here


                start = i * chunk_size_ms
                end = start + chunk_size_ms
                chunk = sound[start:end]
                temp_chunk_path = f"temp_chunk_{i}.wav"
                chunk.export(temp_chunk_path, format="wav")

                with sr.AudioFile(temp_chunk_path) as source:
                    audio_data = r.record(source)

                try:
                    part = r.recognize_google(audio_data, language=source_lang)
                    full_text += " " + part
                    recognized_chunks += 1  # ✅ Count successful recognitions
                    print(f"✅ Chunk {i + 1}: Recognized")
                except sr.UnknownValueError:
                    print(f"❌ Chunk {i + 1}: Could not understand")
                except sr.RequestError as e:
                    print(f"❌ Chunk {i + 1}: API Error - {e}")
                    break

                os.remove(temp_chunk_path)  # cleanup
            # Yeh LOOP ke baad hona chahiye:
            print(f"🧩 Total Recognized Chunks: {recognized_chunks}")

            if not full_text.strip():
                print("❌ No speech detected in any chunk.")
                sys.exit(1)

            text = full_text
            print(f"✅ Combined recognized text: {text[:100]}...")
            print(f"🧩 Characters in Recognized Hindi Text: {len(text)}")


        except sr.RequestError as e:
            print(f"Speech recognition API request failed: {e}")
            sys.exit(1)
        except sr.UnknownValueError:
            print("Could not understand audio")
            sys.exit(1)
        except Exception as e:
            print(f"Error during speech recognition: {str(e)}")
            sys.exit(1)
        finally:
            if os.path.exists(audio_path):
                os.remove(audio_path)

        try:
            print("🧠 Translating recognized Hindi text to English...")
            translator = Translator()

            print(f"🧩 Characters in Recognized Hindi Text: {len(text)}")

            chunks = textwrap.wrap(text, width=100)
            print(f"🔍 Total Translation Chunks: {len(chunks)}")

            translated_chunks = []
            for i, chunk in enumerate(chunks):
                try:
                    translated_piece = translator.translate(chunk, src=source_lang, dest=target_lang).text
                    translated_chunks.append(translated_piece)
                    print(f"✅ Translated chunk {i + 1}, length: {len(translated_piece)} chars")
                except Exception as e:
                    print(f"❌ Translation error in chunk {i + 1}: {e}")

            translated = ' '.join(translated_chunks)

            print("🔎 Full Recognized Text:")
            print(text)
            print("🌐 Full Translated Text:")
            print(translated)
            print(f"🧩 Characters in Translated Text: {len(translated)}")
            print(f"✅ Combined recognized text: {text[:100]}...")





        except Exception as e:
            print(f"Translation failed: {str(e)}")
            sys.exit(1)

        try:
            print("Generating speech with EdgeTTS...")

            output_base = os.path.basename(input_file).split('.')[0]
            output_audio_path = f"outputs/dubbed_{output_base}.mp3"

            tts_chunks = textwrap.wrap(translated, width=700)
            print(f"🧩 Total TTS chunks: {len(tts_chunks)}")

            asyncio.run(generate_edge_audio(tts_chunks, target_lang, output_audio_path))

        except Exception as e:
            print(f"Text-to-speech failed: {str(e)}")
            sys.exit(1)

        # ONLY ONE FINAL OUTPUT
        if file_ext in ['.mp4', '.mov', '.mkv', '.avi']:
            try:
                final_video = VideoFileClip(input_file)
                final_audio = AudioFileClip(output_audio_path)

                if final_audio.duration > final_video.duration:
                    final_audio = final_audio.subclip(0, final_video.duration)

                final_video = final_video.set_audio(final_audio)
                output_video_path = f"outputs/translated_{os.path.basename(input_file)}"
                final_video.write_videofile(
                    output_video_path,
                    codec='libx264',
                    audio_codec='aac',
                    threads=4
                )
                final_video.close()
                final_audio.close()
                print(output_video_path)
            except Exception as e:
                print(output_audio_path)
        else:
            print(output_audio_path)
    except Exception as e:
        print(f"Unexpected error: {str(e)}")
        sys.exit(1)

if __name__ == "__main__":
    main()
