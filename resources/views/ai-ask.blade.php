<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat AI Wisata Sumatera Barat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            font-size: 28px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .chat-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            min-height: 300px;
            max-height: 500px;
            overflow-y: auto;
        }

        #answer {
            white-space: pre-line;
            line-height: 1.6;
            color: #333;
            font-size: 16px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .loading {
            text-align: center;
            color: #667eea;
            font-style: italic;
        }

        .input-group {
            display: flex;
            gap: 10px;
        }

        #question {
            flex: 1;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            font-family: inherit;
            resize: vertical;
            min-height: 60px;
            transition: border-color 0.3s;
        }

        #question:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .error {
            color: #e74c3c;
            background: #ffeaea;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #e74c3c;
            margin-top: 10px;
        }

        .success {
            color: #27ae60;
            background: #eafaf1;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #27ae60;
            margin-top: 10px;
        }

        .example-questions {
            margin-top: 20px;
            padding: 15px;
            background: #f0f4ff;
            border-radius: 10px;
        }

        .example-questions h4 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .example-questions button {
            background: white;
            color: #667eea;
            border: 1px solid #667eea;
            padding: 8px 15px;
            margin: 5px;
            font-size: 12px;
            font-weight: normal;
        }

        .example-questions button:hover {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🤖 Chat AI Wisata Sumatera Barat</h2>
        <p class="subtitle">Tanyakan apapun tentang tempat wisata di Sumatera Barat</p>

        <div class="chat-container">
            <div id="answer" class="loading">💬 Tanyakan sesuatu tentang tempat wisata di Sumatera Barat...</div>
        </div>

        <div class="input-group">
            <textarea 
                id="question" 
                rows="2" 
                placeholder="Contoh: Apa saja tempat wisata menarik di Padang?"
            ></textarea>
            <button id="sendBtn" onclick="sendQuestion()">Kirim</button>
        </div>

        <div class="example-questions">
            <h4>💡 Pertanyaan Contoh:</h4>
            <button onclick="setQuestion('Apa saja tempat wisata menarik di Sumatera Barat?')">
                Tempat Wisata Populer
            </button>
            <button onclick="setQuestion('Dimana lokasi pantai terbaik untuk liburan?')">
                Rekomendasi Pantai
            </button>
            <button onclick="setQuestion('Apa saja aktivitas yang bisa dilakukan di Bukittinggi?')">
                Aktivitas di Bukittinggi
            </button>
        </div>
    </div>

    <script>
        const questionInput = document.getElementById('question');
        const sendBtn = document.getElementById('sendBtn');
        const answerDiv = document.getElementById('answer');

        // Fungsi untuk set pertanyaan dari contoh
        function setQuestion(question) {
            questionInput.value = question;
            questionInput.focus();
        }

        // Handle Enter key (Shift+Enter untuk newline, Enter untuk kirim)
        questionInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendQuestion();
            }
        });

        async function sendQuestion() {
            const question = questionInput.value.trim();

            if (!question) {
                answerDiv.innerHTML = '<div class="error">⚠️ Silakan masukkan pertanyaan terlebih dahulu.</div>';
                return;
            }

            // Disable button dan tampilkan loading
            sendBtn.disabled = true;
            sendBtn.textContent = '⏳ Mengirim...';
            answerDiv.innerHTML = '<div class="loading">⏳ Sedang memproses pertanyaan Anda...</div>';

            try {
                const response = await fetch('/ask-ai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ question })
                });

                const data = await response.json();

                if (!response.ok || data.error) {
                    throw new Error(data.error || 'Terjadi kesalahan pada server');
                }

                if (data.success && data.answer) {
                    answerDiv.innerHTML = data.answer;
                } else {
                    throw new Error('Format response tidak valid');
                }

            } catch (error) {
                answerDiv.innerHTML = `<div class="error">❌ ${error.message}</div>`;
                console.error('Error:', error);
            } finally {
                // Enable button kembali
                sendBtn.disabled = false;
                sendBtn.textContent = 'Kirim';
            }
        }
    </script>
</body>
</html>
