 // Restricts input for the given textbox to the given inputFilter.
 function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}
setInputFilter(document.getElementById("start-year"), function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 2100); });
    setInputFilter(document.getElementById("end-year"), function(value) {
        return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 2100); });
        setInputFilter(document.getElementById("lec-time"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 50); });
            setInputFilter(document.getElementById("tuto-time"), function(value) {
                return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 50); });
                setInputFilter(document.getElementById("credit_unit"), function(value) {
                    return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 5); });