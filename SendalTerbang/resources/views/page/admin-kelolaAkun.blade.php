<style>
.akun-container {
    width: 98%;
    margin: 20px auto;
    font-family: 'Segoe UI', sans-serif;
}

/* HEADER */
.akun-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

/* SEARCH BOX */
.search-box {
    display: flex;
    gap: 8px;
}

.search-box input {
    width: 250px;
    border: 2px solid rgb(230, 230, 230);
    border-radius: 6px;
    padding: 9px 12px;
    background: rgb(251, 251, 251);
    transition: .2s;
    font-size: 14px;
}

.search-box input:focus {
    border-color: rgb(42, 119, 224);
    background: white;
}

.btn-reset {
    padding: 9px 16px;
    border-radius: 6px;
    border: none;
    background: rgb(216, 216, 216);
    font-size: 14px;
    cursor: pointer;
    transition: .2s;
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

/* TABLE */
.akun-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 6px;
    overflow: hidden;
    font-size: 14px;
}

.akun-table thead {
    background: rgb(42, 119, 224);
    color: white;
    font-weight: bold;
}

.akun-table th, .akun-table td {
    padding: 14px 10px;
    border-bottom: 1px solid rgb(230, 230, 230);
}

.akun-table tbody tr:hover {
    background: rgb(247, 247, 247);
}

.cenCol {
    text-align: center;
}

/* BUTTON INFO */
.project-info-button {
    padding: 6px 12px;
    background: rgb(231, 41, 155);
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    transition: .2s;
    font-size: 12px;
}

.project-info-button:hover {
    background: rgb(199, 36, 134);
}

</style>

<div class="akun-container">

    <div class="akun-header">

        <div class="search-box">
            <input class="find-mhs-input" onkeyup="find_mahasiswa()" type="text" placeholder="Cari akun...">
            <button class="btn-reset" onclick="reset_mahasiswa_bar()">Reset</button>
        </div>

        <a href="/admin-tambah-akun" class="btn-tambah">
            <span>＋</span> Tambah Akun
        </a>
    </div>

    <table class="akun-table list-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody class="value-list-table">
        </tbody>
    </table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>    
    let data_mahasiswa = [];

    setInterval(checkInput, 1000);

    function load_data( search_by = "" ){
        let link = "/api/v3/mahasiswa";
        if(search_by != ""){
            link = "/api/v3/mahasiswa/keyword/" + search_by;
        }
        let data = fetch(link)
        .then(Response => Response.json())
        .then(data => data_mahasiswa = data['data'])
        .then(set => setDataColumn(search_by));
    }
    
    function setDataColumn(search_by = ""){
        $(".value-list-table").html("  ");
        for( let i = 0; i< data_mahasiswa.length; i++ ){
            $(".value-list-table").append(
                "<tr>"+
                    "<td class='cenCol'>"+ (i+1)+ "</td>"+
                    "<td class='cenCol'>"+ data_mahasiswa[i]['nim'] +"</td>"+
                    "<td class=''>"+ data_mahasiswa[i]['nama'] +"</td>"+
                    "<td class='cenCol'>" + data_mahasiswa[i]['angkatan'] + "</td>"+
                    "<td class=''>"+ data_mahasiswa[i]['email'] +"</td>"+
                    "<td class='cenCol'>"+
                        "<a href='admin-kelola-akun/"+ data_mahasiswa[i]['nim'] +"'>"+
                            "<button class='project-info-button'>Info</button>"+
                        "</a>"+
                    "</td>"+
                "</tr>"
            );    
        }
    }
    load_data();

    function find_mahasiswa(){
        let input_value = $(".find-mhs-input").val();
        load_data(input_value);
    }

    function checkInput(){
        if($(".find-mhs-input").val() == ""){
            load_data();
        }
    }

    function reset_mahasiswa_bar(){
        $(".find-mhs-input").val("");
    }

</script>
