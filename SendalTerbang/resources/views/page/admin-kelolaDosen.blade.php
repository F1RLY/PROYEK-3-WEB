<style>
    .akun-container {
    width: 98%;
    margin: 20px auto;
    font-family: 'Segoe UI', sans-serif;
}

.akun-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

/* SEARCH */
.search-box {
    display: flex;
    gap: 8px;
}

.search-box input {
    width: 220px;
    border: 2px solid rgb(230, 230, 230);
    border-radius: 6px;
    padding: 9px 12px;
    background: rgb(251, 251, 251);
    transition: .2s;
}

.search-box input:focus {
    border-color: rgb(42, 119, 224);
    background: white;
}

.btn-search, .btn-reset {
    padding: 9px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    transition: .2s;
    text-decoration: none;
}

.btn-search {
    background: rgb(42, 119, 224);
    color: white;
}

.btn-search:hover {
    background: rgb(31, 96, 186);
}

.btn-reset {
    background: rgb(216, 216, 216);
}

.btn-reset:hover {
    background: rgb(200, 200, 200);
}

/* TOMBOL TAMBAH */
.btn-tambah {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgb(231, 41, 155);
    color: white;
    padding: 10px 15px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: .2s;
}

.btn-tambah:hover {
    background: rgb(199, 36, 134);
}

/* TABEL */
.akun-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 6px;
    overflow: hidden;
}

.akun-table thead {
    background: rgb(42, 119, 224);
    color: white;
    font-weight: bold;
}

.akun-table th, .akun-table td {
    padding: 14px 10px;
    border-bottom: 1px solid rgb(230, 230, 230);
    text-align: left;
}

.akun-table tbody tr:hover {
    background: rgb(247, 247, 247);
}

/* TOMBOL HAPUS */
.btn-hapus {
    padding: 6px 12px;
    background: rgb(238, 61, 61);
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
    transition: .2s;
}

.btn-hapus:hover {
    background: rgb(204, 51, 51);
}

</style>
<div class="akun-container">

    <div class="akun-header">
        <form action="" method="GET" class="search-box">
            <input type="text" name="cari" placeholder="Cari akun dosen...">
            <button type="submit" class="btn-search">Cari</button>
            <a href="" class="btn-reset">Reset</a>
        </form>

        <a href="/admin-tambah-dosen" class="btn-tambah">
            <span>＋</span> Tambah Dosen
        </a>
    </div>

    <table class="akun-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody class="value-list-table">
            <!-- <tr>
                <td>1</td>
                <td>69435f6c587d</td>
                <td>Mohammad Ali Fikri, S.Kom.</td>
                <td>
                    <button class="btn-hapus">Hapus</button>
                </td>
            </tr> -->
        </tbody>
    </table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/dosen_setup.js') }}"></script>