let data;
let table;
let key;

function init() {
    table = document.getElementById("table");
    data = EmpireUtils.getJsonDataFromDiv("dom-target")['stats'];
    key = EmpireUtils.getJsonDataFromDiv("dom-target-key");
    showCustom();
}

function showCustom() {
    clearTable();
    let customKey = key['custom'];

    let head = table.appendChild(document.createElement("tr"));
    EmpireUtils.addEvent(head.appendChild(document.createElement("th")), 2).textContent = "States";
    EmpireUtils.addEvent(head.appendChild(document.createElement("th")), 2).textContent = "Valeurs";

    let currentData = data['minecraft:custom'];
    for (let key in customKey) {
        let line = table.appendChild(document.createElement("tr"));
        line.appendChild(document.createElement("td")).textContent = key.split(":")[1];
        line.appendChild(document.createElement("td")).textContent = (currentData[key] == null ? "0" : EmpireUtils.morphValue(currentData[key], customKey[key]));
    }
}

function showBlock()  {
    showTab("Item / Block ", "block", ["minecraft:mined", "Miner"], ["minecraft:broken", "Casser"], ["minecraft:crafted", "Fabriquer"], ["minecraft:used", "Utilisation"],  ["minecraft:picked_up", "Ramasser"], ["minecraft:dropped", "Jeter"]);
}

function showMob() {
    showTab("Mob", "mob",  ["minecraft:killed", "Tuer"], ["minecraft:killed_by", "Tué par"]);
}

function showTab(first, generalCategory, ...categories) {
    clearTable();

    let head = table.appendChild(document.createElement("tr"));
    EmpireUtils.addEvent(head.appendChild(document.createElement("th")),2).textContent = first;
    for (let category of categories) {
        EmpireUtils.addEvent(head.appendChild(document.createElement("th")), 2).textContent = category[1];
    }

    let blockKey = key[generalCategory];
    for (let key in blockKey) {

        let value = [];
        let notAllNull = false;
        for (let category of categories) {
            const currentData = data[category[0]];
            notAllNull = currentData != null;
            let v = null;
            if(notAllNull)
            {
                v = currentData[key];
                notAllNull = notAllNull || (v != null && v !== 0 && v !== "0");
            }
            value.push((v == null ? "0" : v));

        }
        if(notAllNull)
        {
            let line = table.appendChild(document.createElement("tr"));
            line.appendChild(document.createElement("td")).textContent = key.split(":")[1];
            for (let e of value) {
                line.appendChild(document.createElement("td")).textContent = e;
            }
        }
    }

}



function clearTable() {
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }
}
