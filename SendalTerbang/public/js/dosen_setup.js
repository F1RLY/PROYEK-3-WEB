const urlParam = new URLSearchParams(window.location.search);
let dosenList = [];

setInterval(setDosenList, 2000);

loadData()
.then(response => setDosenList());

async function loadData(keyword =''){
    let link = `${urlParam}/api/admin/dosen/${keyword}`;
    
    fetch(link)
    .then(data => data.json())
    .then(response => dosenList = response['data']);
}

function setDosenList(){
    $('.value-list-table').html('');
    for(let i=0; i<dosenList.length; i++){
        $('.value-list-table').append(
            `<tr>`+
                `<td>${i+1}</td>`+
                `<td>${dosenList[i]['kode']}</td>`+
                `<td>${dosenList[i]['username']}</td>`+
                `<td><button class="btn-hapus" >Hapus</button></td>`+
            `</tr>`
        );
    }
}