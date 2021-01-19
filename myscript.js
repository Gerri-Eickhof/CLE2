const picker = document.getElementById('calendar');
picker.addEventListener('input', function(e){
    var day = new Date(this.value).getDay();
    console.log("de dag is" + day);
    if([0, 2, 4, 5].includes(day)){
        e.preventDefault();
        this.value = '';
        alert('Alleen maandag, woensdag en zaterdag!');
    }
});