<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    /* 1. MENGATUR BODY & MAIN AGAR FULL SCREEN */
    body { 
        background-color: #e5ddd5; 
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden; /* Mencegah layar ikut ke-scroll */
    }
    
    /* Memastikan tag main dari layout tidak ada margin */
    main {
        padding: 0 !important;
        margin: 0 !important;
        height: calc(100vh - 70px); /* 70px adalah tinggi navbar atas */
    }

    /* 2. CHAT CONTAINER FULL SCREEN */
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 100%; /* Memenuhi sisa layar di bawah navbar */
        width: 100%;
        background-color: #efeae2;
        background-image: url("https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png");
        background-size: cover;
        /* HAPUS border-radius dan box-shadow karena sudah full screen */
    }

    /* 3. HEADER CHAT */
    .chat-header { 
        background-color: #0f172a; 
        color: white; 
        padding: 15px 20px; 
        font-weight: bold; 
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 10;
    }

    /* 4. AREA PESAN */
    .chat-box { 
        flex: 1; 
        padding: 20px 20px 20px 30px; /* Padding kiri agak besar */
        overflow-y: auto; 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
    }

    /* Scrollbar Rapih */
    .chat-box::-webkit-scrollbar { width: 8px; }
    .chat-box::-webkit-scrollbar-track { background: transparent; }
    .chat-box::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.2); border-radius: 10px; }
    
    /* 5. BUBBLE CHAT */
    .message-wrapper { max-width: 70%; position: relative; display: flex; flex-direction: column; }
    .message-wrapper.mine { align-self: flex-end; }
    .message-wrapper.other { align-self: flex-start; }
    
    .message-bubble { 
        padding: 10px 30px 10px 15px; 
        border-radius: 8px; 
        font-size: 14px; 
        box-shadow: 0 1px 1px rgba(0,0,0,0.1); 
        position: relative; 
    }
    .message-mine { background-color: #d9fdd3; border-top-right-radius: 0; }
    .message-other { background-color: #ffffff; border-top-left-radius: 0; }
    
    .message-info { font-size: 11px; margin-bottom: 3px; display: block; font-weight: bold; }
    .message-mine .message-info { color: #15803d; text-align: right; }
    .message-other .message-info { color: #2563eb; }

    /* 6. MENU TITIK TIGA */
    .options-btn { position: absolute; top: 5px; right: 5px; background: transparent; border: none; font-size: 18px; cursor: pointer; color: #666; opacity: 0; transition: opacity 0.2s; z-index: 10; }
    .message-wrapper:hover .options-btn { opacity: 1; }
    
    .dropdown-menu { display: none; position: absolute; top: 30px; right: 8px; background: white; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 20; min-width: 140px; }
    .dropdown-menu button { width: 100%; padding: 10px; border: none; background: none; text-align: left; cursor: pointer; font-size: 13px; color: #333; }
    .dropdown-menu button:hover { background: #f0f0f0; color: #007bff; }
    .dropdown-menu button.delete-btn:hover { color: red; }
    
    /* 7. AREA KETIK PESAN (Bawah) */
    .chat-input-area { 
        display: flex; 
        padding: 15px 30px; 
        background-color: #f0f0f0; 
        border-top: 1px solid #ddd; 
    }
    .chat-input-area input[type="text"] { flex: 1; padding: 15px 20px; border: none; border-radius: 25px; outline: none; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); font-size: 15px; }
    .chat-input-area button { margin-left: 15px; padding: 10px 30px; background-color: #0f172a; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold; transition: background 0.2s; }
    .chat-input-area button:hover { background-color: #1e293b; }
</style>

<div class="chat-container">
    <div class="chat-header">Ruang Obrolan PKL</div>
    
    <div class="chat-box" id="chat-box"></div>

    <form class="chat-input-area" id="chat-form">
        <!-- Kotak Preview Pesan yang Dikutip -->
        <div id="reply-preview">
            <b id="reply-name"></b>
            <span id="reply-text"></span>
            <span class="close-reply" onclick="batalBalas()">✖</span>
        </div>

        <div class="input-row">
            <input type="hidden" id="reply-to-id" value="">
            <input type="text" id="message-input" placeholder="Ketik pesan di sini..." autocomplete="off" required>
            <button type="submit" id="send-btn">Kirim</button>
        </div>
    </form>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    const replyPreview = document.getElementById('reply-preview');
    const replyName = document.getElementById('reply-name');
    const replyText = document.getElementById('reply-text');
    const replyToId = document.getElementById('reply-to-id');
    
    const myUserId = "<?= session()->get('id') ?>";
    const myRole   = "<?= session()->get('role') ?>";

    function loadMessages() {
        fetch('<?= base_url('chat/fetch') ?>')
            .then(response => response.json())
            .then(data => {
                chatBox.innerHTML = ''; 
                
                data.forEach(msg => {
                    const isMine = String(msg.user_id) === String(myUserId);
                    
                    const wrapper = document.createElement('div');
                    wrapper.className = `message-wrapper ${isMine ? 'mine' : 'other'}`;

                    const bubble = document.createElement('div');
                    bubble.className = `message-bubble ${isMine ? 'message-mine' : 'message-other'}`;
                    
                    // Render Kotak Kutipan (Jika pesan ini adalah balasan)
                    let quotedHtml = '';
                    if (msg.reply_to) {
                        quotedHtml = `
                            <div class="quoted-box">
                                <b>${msg.reply_to.nama}</b>
                                ${msg.reply_to.isi}
                            </div>
                        `;
                    }

                    bubble.innerHTML = `
                        <span class="message-info">${msg.nama} - ${msg.waktu}</span>
                        ${quotedHtml}
                        <div style="margin-top:5px;">${msg.isi}</div>
                    `;
                    
                    wrapper.appendChild(bubble);

                    // Tombol Titik Tiga (Balas & Hapus)
                    if (true) { // Tombol balas muncul untuk semua pesan
                        const optionsBtn = document.createElement('button');
                        optionsBtn.className = 'options-btn';
                        optionsBtn.innerHTML = '&#8942;';
                        
                        const dropdown = document.createElement('div');
                        dropdown.className = 'dropdown-menu';
                        
                        // Tombol Balas
                        let menuHtml = `<button onclick="balasPesan(${msg.id}, '${msg.nama}', \`${msg.isi.replace(/`/g, '\\`')}\`)">↩️ Balas</button>`;
                        
                        // Tombol Hapus (jika pesan sendiri / admin)
                        if (isMine || myRole === 'admin') {
                            menuHtml += `<button class="delete-btn" onclick="hapusPesan(${msg.id})">🗑️ Hapus</button>`;
                        }
                        
                        dropdown.innerHTML = menuHtml;

                        optionsBtn.onclick = function(e) {
                            e.stopPropagation(); 
                            document.querySelectorAll('.dropdown-menu').forEach(el => el.style.display = 'none');
                            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                        };

                        wrapper.appendChild(optionsBtn);
                        wrapper.appendChild(dropdown);
                    }

                    chatBox.appendChild(wrapper);
                });
                
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }

    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(el => el.style.display = 'none');
    });

    // FUNGSI UNTUK MEMBALAS PESAN
    function balasPesan(id, nama, isi) {
        replyPreview.style.display = 'block';
        replyName.innerText = nama;
        replyText.innerText = isi;
        replyToId.value = id;
        messageInput.focus(); // Fokus ke kolom ketik
    }

    function batalBalas() {
        replyPreview.style.display = 'none';
        replyToId.value = '';
    }

    function hapusPesan(id) {
        if (confirm('Yakin ingin menghapus pesan ini?')) {
            fetch('<?= base_url('chat/delete/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') loadMessages();
                    else alert(data.message); 
                });
        }
    }

    loadMessages();
    setInterval(loadMessages, 2000);

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault(); 
        const isiPesan = messageInput.value;
        if (isiPesan.trim() === '') return;

        const formData = new FormData();
        formData.append('isi', isiPesan);
        formData.append('reply_to_id', replyToId.value); // Kirim ID kutipan ke Controller

        fetch('<?= base_url('chat/send') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                messageInput.value = ''; 
                batalBalas(); // Sembunyikan kotak preview
                loadMessages(); 
            }
        });
    });
</script>

<?= $this->endSection() ?>