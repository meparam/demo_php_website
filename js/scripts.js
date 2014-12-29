function showAdditionalCopyrights() {
    var hidden_block = document.getElementById("additional_copyrights");
    var display_state = window.getComputedStyle(hidden_block, null).getPropertyValue("display");
    /* AWOOGA! ON IE use element.currentStyle */
    if (display_state == "none")
        hidden_block.style.display = "block";
    else
        hidden_block.style.display = "none";
}

function onLoadCodePageSpecific() {}