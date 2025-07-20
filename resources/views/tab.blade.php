< ! DOCTYPE html >
< html lang = "sim" >
< cabeça >
    < meta charset = "UTF-8" >
    < meta nome = "viewport" conteúdo = "largura=largura-do-dispositivo, escala-inicial=1.0" >
    < title > Tabela de multiplicação < /title >
< /cabeça >
< corpo >
    < h1 > Tabela de multiplicação para { { $number } } < /h1 >   
    < borda da tabela = "1" >
        < tr >
            < th > Multiplicador < /th >
            < th > Resultado < /th >
        < /tr >
        @ para ( $i = 1 ; $i < = 10 ; $i + + )    
            < tr >
                < td > { { $i } } < /td >  
                < td > { { $i * $número } } < /td >  
            < /tr >
        @ fim para
    < /tabela >
< /corpo >
< /html >