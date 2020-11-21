
let select;
let data;

function init() {
    select = document.getElementById('key-select');
    // let dat = document.getElementById('dat').textContent;
    data = EmpireUtils.getJsonDataFromDiv('dat');
    setSelect("custom");
}

$(document).ready(function() {
    $('#key-select').select2();
});

function setSelect(categories) {
    clearSelect();
    for (let datumKey in data[categories]) {
        let opt = document.createElement("option");
        opt.setAttribute("value", categories + ";" + datumKey);
        opt.textContent = datumKey.split(':')[1];
        select.appendChild(opt);
    }
}



function clearSelect() {
    select.textContent = "";
}
