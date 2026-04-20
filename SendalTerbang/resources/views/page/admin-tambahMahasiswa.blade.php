<div class="tambah-akun detail-proyek">

    <h1>Tambah Akun mahasiswa</h1>

    <form action="create-akun-mahasiswa" method="post">
        @csrf
        <div class="detail-list">
            <li class="detail-link">Nama : 
                <ul>
                    <input class="detail-value" name="nama" id="nama" type="text" placeholder="nama">
                </ul>
            </li>
            <li class="detail-link">Nomor Induk mahasiswa : 
                <ul>
                    <input class="detail-value" name="nim" id="nama" type="text" placeholder="nomor induk">
                </ul>
            </li>
            <li class="detail-link">Angkatan : 
                <ul>
                    <input class="detail-value" name="angkatan" type="text" placeholder="2025">
                </ul>
            </li>
            <li class="detail-link">Email : 
                <ul>
                    <input class="detail-value" name="email" type="email" placeholder="email@gmail.com">
                </ul>
            </li>
            <li class="detail-link">Password : 
                <ul>
                    <input class="detail-value" name="password" type="password" placeholder="hehe">
                </ul>
            </li>
            <li class="detail-link">Confirm Password : 
                <ul>
                    <input class="detail-value" name="password-confirm" type="password" placeholder="hehe">
                </ul>
            </li>
            <li class="detail-link">Kelas : 
                <ul>
                    <select class="select-option" name="kelas" id="kelas">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </ul>
            </li>
            <li class="detail-link">Web : 
                <ul>
                    <input class="detail-value" name="web" type="password" placeholder="web">
                </ul>
            </li>
        </div>
        <div class="button-act">
            <button name="submit" value="false" class="cancel">Batal</button>
            <button name="submit" value="true" class="submit">Submit</button>
        </div>

    </form>

</div>