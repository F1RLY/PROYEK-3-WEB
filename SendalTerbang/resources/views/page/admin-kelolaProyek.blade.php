<?php
use App\Models\Hash;
?>

<style>
    .list-project {
        margin-top: 20px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        /* border: 1px solid #dcdcdc; */
        /* box-shadow: 0 2px 5px rgba(0,0,0,0.05); */
    }

    .find-project {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .find-proyek-input {
        flex: 1;
        padding: 10px 14px;
        border: 1px solid #cccccc;
        outline: none;
        border-radius: 6px;
        transition: 0.2s;
        font-size: 14px;
    }

    .find-proyek-input:focus {
        border-color: #7c4dff;
        box-shadow: 0 0 4px rgba(124, 77, 255, 0.3);
    }

    .find-project-button {
        padding: 10px 18px;
        background: #d81b60;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s;
    }

    .find-project-button:hover {
        background: #b21751;
    }

    .list-table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 6px;
        font-size: 14px;
    }

    .list-table th {
        background: #3f51b5;
        color: white;
        padding: 12px;
        font-weight: bold;
        text-align: center;
    }

    .list-table td {
        padding: 12px;
        border-bottom: 1px solid #eaeaea;
    }

    tr:nth-child(even) {
        background: #fafafa;
    }

    tr:hover {
        background: #ede7f6;
    }

    .cenCol {
        text-align: center;
    }

    .project-info-button {
        background: #7c4dff;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
    }

    .project-info-button:hover {
        background: #6a3de0;
    }
</style>

<div class="table list-project">

    <div class="find-project">
        <input class="find-proyek-input" onkeydown="find_proyek()" type="text" placeholder="cari Proyek">
        <button class="find-project-button" onclick="reset_project_bar()">Reset</button>
    </div>

    <table class="table list-table">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Link</th>
            <th>Updated</th>
            <th>Aksi</th>
        </tr>
        <tbody class="value-list-table-proyek">
            @for ($i=0; $i<count($proyek); $i++)
                <tr>
                    <td class="cenCol">{{ $i+1 }}</td>
                    <td class="">{{ $proyek[$i]['judul'] }}</td>
                    <td class="">{{ $proyek[$i]['link'] }}</td>
                    <td class="cenCol">{{ $proyek[$i]['updated_at'] }}</td>
                    <td class="cenCol">
                        <a href="admin-detail-proyek/{{ $proyek[$i]['repoCode'] }}">
                            <button class='project-info-button'>Info</button>
                        </a>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>    
    let data_proyek = [];
    const input_proyek_bar = ".find-proyek-input";
    setInterval(checkInput, 1000);

    function load_proyek_data( search_by = "" ){
        console.log("cari " + search_by );
        let link = "/api/v3/proyek";
        if(search_by != ""){
            link = "/api/v3/proyek/keyword/" + search_by;
        }
        let data = fetch(link)
        .then(Response => Response.json())
        .then(data => data_proyek = data['data'])
        .then(set => setDataColumn(search_by));
    }
    
    function setDataColumn(search_by = ""){
        $(".value-list-table-proyek").html("  ");
        for( let i = 0; i< data_proyek.length; i++ ){
            $(".value-list-table-proyek").append(
                "<tr>"+
                    "<td class='cenCol'>"+ (i+1)+ "</td>"+
                    "<td class=''>"+ data_proyek[i]['judul'] +"</td>"+
                    "<td class=''><a target='_blank' href='"+ data_proyek[i]['link'] +"'>"+ data_proyek[i]['link'] +"</a></td>"+
                    "<td class='cenCol'>" + data_proyek[i]['updated_at'] + "</td>"+
                    "<td class='cenCol'>"+
                        "<a href='admin-detail-proyek/"+ data_proyek[i]['repoCode'] +"'>"+
                            "<button class='project-info-button'>Info</button>"+
                        "</a>"+
                    "</td>"+
                "</tr>"
            );    
        }
    }

    load_proyek_data();

    function find_proyek(){
        let input_value = $(input_proyek_bar).val();
        load_proyek_data(input_value);
    }

    function checkInput(){
        if($(input_proyek_bar).val() == ""){
            load_proyek_data();
        }
    }

    function reset_project_bar(){
        $(input_proyek_bar).val("");
    }

</script>