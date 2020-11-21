
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
        v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

class EmpireUtils {
    static morphValue(value, type) {
        switch (type) {
            case 0:
                return value + "";
            case 1:
                let a = value / 100.0;
                let b = a / 100.0;
                if (b > 0.5)
                {
                    return EmpireUtils.decimalFormat(b) + " Km";
                }
                else
                {
                    return a > 0.5 ? EmpireUtils.decimalFormat(a) + " m" : value + " cm";
                }

            case 2:
                return EmpireUtils.decimalFormat(value * 0.1);
            case 3:
                let d = value / 20.0;
                let e = d / 60.0;
                let f = e / 60.0;
                let g = f / 24.0;
                let h = g / 365.0;
                if (h > 0.5)
                {
                    return EmpireUtils.decimalFormat(h) + " y";
                }
                else if (g > 0.5)
                {
                    return EmpireUtils.decimalFormat(g) + " d";
                }
                else if (f > 0.5)
                {
                    return EmpireUtils.decimalFormat(f) + " h";
                }
                else
                {
                    return e > 0.5 ? EmpireUtils.decimalFormat(e) + " m" : d + " s";
                }
            default:
                return value + "";
        }

    }

    static getJsonDataFromDiv(divId)
    {
        let dat = document.getElementById(divId).textContent;
        return  JSON.parse(dat);
    }

    static decimalFormat(value) {
        return (Math.round(value * 100) / 100).toFixed(2);
    }

    static addEvent(th, s) {
        th.addEventListener('click', (() => {
            const table = th.closest('table');
            Array.from(table.querySelectorAll('tr:nth-child(n+' + (s + 1) +')'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => table.appendChild(tr) );
        }));
        return th;
    }
}