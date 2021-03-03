document.addEventListener('DOMContentLoaded', function (){
    let form = document.getElementById('secret-word-form') ;
    let inputs = form.querySelectorAll("input[type='text']:enabled") ;
    try{
        inputs[0].focus()
    }catch (e){}
    let input;
    for (input of inputs){
        input.addEventListener('keypress', function (e){
            e.preventDefault() ;
            if (e.key === 'Enter') {
                form.submit() ;
            }else{
                e.target.value = e.key
                let next_input = nextLetterInput(e.target)
                if (next_input) next_input.focus()
            }
        })
    }
})

function nextLetterInput(from){
    let next_input = from.nextElementSibling
    while (next_input && (next_input.type !== 'text' || next_input.disabled)){
        /*next_input.style.background = 'black'*/
        next_input = next_input.nextElementSibling ;
    }
    return next_input
}