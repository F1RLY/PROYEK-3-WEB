<style>

    .register-container {
        width: 400px;
        margin: 40px auto;
        background: white;
        padding: 25px 30px;
        border-radius: 8px;
        border: 1px solid rgb(236, 236, 236);
        font-family: 'Segoe UI', sans-serif;
    }
    
    .title {
        font-size: 24px;
        font-weight: bold;
        color: rgb(42, 119, 224);
        margin-bottom: 25px;
    }
    
    .input-box {
        display: flex;
        flex-direction: column;
        margin-bottom: 18px;
    }
    
    .input-box label {
        font-size: 15px;
        margin-bottom: 5px;
        color: rgb(70, 70, 70);
    }
    
    .input-box input {
        padding: 11px 10px;
        border: 2px solid rgb(230, 230, 230);
        border-radius: 6px;
        background: rgb(251, 251, 251);
        transition: .2s;
    }
    
    .input-box input:focus {
        border-color: rgb(42, 119, 224);
        background: white;
    }
    .submit-btn {
        width: 100%;
        padding: 13px 0;
        margin-top: 8px;
        background: rgb(42, 119, 224);
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: .2s;
    }
    
    .submit-btn:hover {
        background: rgb(31, 96, 186);
    }
</style>

<div class="register-container">
    <h2 class="title">Daftar Dosen</h2>

    <form action="/admin-tambah-dosen" method="POST">
        @csrf
        
        <div class="input-box">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username">
        </div>

        <div class="input-box">
            <label>Email</label>
            <input type="text" name="email" placeholder="Masukkan email">
        </div>

        <div class="input-box">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password">
        </div>

        <div class="input-box">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Masukkan ulang password">
        </div>

        <button class="submit-btn">Daftar</button>
    </form>
</div>
