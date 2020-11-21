let data;
let table;
let keys;
let categoryHelper = {"custom": [["minecraft:custom", "stats"]], "mob": [["minecraft:killed", "Tuer"], ["minecraft:killed_by", "Tué par"]], "block": [["minecraft:mined", "Miner"], ["minecraft:broken", "Casser"], ["minecraft:crafted", "Fabriquer"], ["minecraft:used", "Utilisation"],  ["minecraft:picked_up", "Ramasser"], ["minecraft:dropped", "Jeter"]]};


function init() {
    table = document.getElementById("table");
    data = EmpireUtils.getJsonDataFromDiv("dom-target");
    keys = EmpireUtils.getJsonDataFromDiv("dom-target-key");
    show_table();

    let th = table.children[1];

    const t = th.closest('table');
    Array.from(t.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), false))
        .forEach(tr => t.appendChild(tr) );

}

function show_table() {
    let category = data['category'];
    let key = data['key'];
    let dat = data['data'];
    let format = keys[category][key];

    let key_head = table.appendChild(document.createElement("tr"));
    key_head.setAttribute("class", "table-header");

    let key_in = key_head.appendChild(document.createElement("th"));
    key_in.textContent = key.split(':')[1].replaceAll('_', ' ');
    key_in.setAttribute("colspan", "100%");
    let head = table.appendChild(document.createElement("tr"));
    head.setAttribute("class", "table-header");
    // head.appendChild(document.createElement("th")).textContent = "Position";
    EmpireUtils.addEvent(head.appendChild(document.createElement("th")), 2).textContent = "Joueur";

    let helper = categoryHelper[category];
    for (let category of helper) {
        EmpireUtils.addEvent(head.appendChild(document.createElement("th")),2 ).textContent = category[1];
    }

    // Array.from(dat).sort( (a, b) => a[0][helper[0]] > b[0][helper[0]]).forEach(userDat => {
    //     let line = table.appendChild(document.createElement("tr"));
    //     // line.appendChild(document.createElement("td")).textContent = i + 1;
    //     line.appendChild(document.createElement("td")).textContent = userDat[2] === "unknown" ? userDat[1] : userDat[2];
    //     let value = userDat[0];
    //     for(let i = 0; i < helper.length; i++)
    //     {
    //         let cat = helper[i][0];
    //         let n = value[cat] == null ? 0 : value[cat];
    //         line.appendChild(document.createElement("td")).textContent = EmpireUtils.morphValue(n, format);
    //     }
    // });

    for(let i = 0; i < dat.length; i++)
    {
        let userDat = dat[i];
        let line = table.appendChild(document.createElement("tr"));
        // line.appendChild(document.createElement("td")).textContent = i + 1;
        line.appendChild(document.createElement("td")).textContent = userDat[2] === "unknown" ? userDat[1] : userDat[2];
        let value = userDat[0];
        for(let i = 0; i < helper.length; i++)
        {
            let cat = helper[i][0];
            let n = value[cat] == null ? 0 : value[cat];
            line.appendChild(document.createElement("td")).textContent = EmpireUtils.morphValue(n, format);
        }
    }
}