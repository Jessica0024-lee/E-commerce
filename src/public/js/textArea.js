function adjustTextareaHeight(textarea) {
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
}

const textarea = document.getElementById("address");

if (textarea) {
    textarea.addEventListener("input", function () {
        adjustTextareaHeight(textarea);
    });

    adjustTextareaHeight(textarea);
}