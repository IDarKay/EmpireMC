
let key = document.getElementById("inputfield");
for (let n = 0; n < 317 ; n++)
{
    console.log('[wordnr=' + n + ']');
    e = document.querySelector("[wordnr='"+ n+"']").textContent;
    console.log(e);
    key.keyup()
}
document.getElementById("wordlist").textContent.replace("|", " ");

let back = "";
document.getElementById("wordlist").textContent.split("|").forEach(value => {
    back += value + " "
});
back = back.substring(0, back.length);

user_input_stream = back;
error_correct = document.getElementById("wordlist").textContent.split("|").length;

asfk_timer = 1;
countdown = 1;