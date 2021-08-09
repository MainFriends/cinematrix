var butacas = 0;

function reply_click(clicked_id){

    if (document.getElementById(clicked_id).src == 'http://localhost/cinematrix/assets/img/butacas/butaca_disponible.svg' && butacas <= 1) 
    {
        document.getElementById(clicked_id).src = 'assets/img/butacas/butaca_seleccionado.svg';
        butacas = butacas + 1
    }
    else if(document.getElementById(clicked_id).src == 'http://localhost/cinematrix/assets/img/butacas/butaca_seleccionado.svg')
    {
        document.getElementById(clicked_id).src = 'assets/img/butacas/butaca_disponible.svg';
        butacas = butacas - 1
    }       
    
} 
 