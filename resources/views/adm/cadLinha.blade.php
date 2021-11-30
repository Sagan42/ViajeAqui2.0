@extends('components.layoutTelaAdm')

@section('contentTelaAdm')
<h2 class = "tituloPagina">Cadastro de Linhas</h2>
    <form action="" method="post" class="container-cadastro-linhas" onchange = "minhaFuncao()">
        @csrf
        <div class="input-radio-linhas">

            <div>
                <label for="radioDireta">Linha Direta &nbsp &nbsp</label>
                <input type="radio" name="linha" id="radioDireta" placeholder="Origem">
            </div>

            <div>
                <label for="radioComum">Linha Comum&nbsp</label>
                <input type="radio" name="linha" id="radioComum"  placeholder="Destino">
            </div>
        </div>

        <div class="input-cidade-origem-destino">

            <label for="origem">Origem</label>
            <input type="text" name="origem" id="origem">

            <div id = "destinosIntermediarios" class="destinosIntermediarios">
                
                <label for="destino1">Destino 1</label>
                <input type="text" name="" id="destino1">

                <label for="destino2">Destino 2</label>
                <input type="text" name="" id="destino2">


            </div>

            <label for="destino">Destino</label>
            <input type="text" name="destino" id="destino">

            
            

        </div>

        <div class="container-numero-linha">
        
            <label for="">Numero da Linha</label>
            <input type="text" name="num_linha" id="" placeholder="Numero da Linha" class="container-linha-input">

        </div>

        <div class="container-valor-passagem">

            <label for="">Valor da Passagem</label>
            <input type="text" name="valor" id="" placeholder="Valor da Passagem" class="container-linha-input">


        </div>
        
        <div class="container-numero-vagas">

            <label for="">Vagas</label>
            <input type="text" name="vagas" id="" >


        </div>



        <div class="container-agenda-linha">
            <label for="">Agenda de Horários</label>
           <a href="#" id="idAgenda"><i class="fas fa-calendar-alt fa-3x"></i></a> 


        </div>

        <div class="container-botao"> 
            <button>
                Cancelar
            </button>

            <button type="submit">
                Confirmar
            </button>


        </div>


        <div class="modalAgenda" id="modalAgenda">
            <div class = "modalAgendaInterno">
                
                <button id="botaoConfirmar" class="botaoConfirmar">Confirmar</button>
                <button id="botaoFechar" class="botaoFechar">X</button>
               
               
                <table class ="tabela-cadastro-linha">
                    
                    <thead>
                        <th>
                            Dia Da Semana
                        </th>

                        <th>
                            Horário
                        </th>
                    </thead>

                    <tbody>

                        <tr>
                            <td>
                                <label for="segunda">Segunda</label>
                                <input type="checkbox" name="diaSemana" id="segunda" onchange = "habilitar(id)">
                            </td>
                            
                            <td>
                            <input type="text" id="horarioSegunda" class="input-horario" disabled>
                               
                        </td>

                        </tr>

                        <tr>

                            <td>
                                <label for="terca">Terca</label>
                                <input type="checkbox" name="diaSemana" id="terca" onchange = "habilitar(id)" >
                            </td>

                            <td>
                                <input type="text" id="horarioTerca" class="input-horario" disabled>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <label for="quarta">Quarta</label>
                                <input type="checkbox" name="diaSemana" id="quarta" onchange = "habilitar(id)">
                            </td>

                            <td>
                                <input type="text" id="horarioQuarta" class="input-horario" disabled>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="quinta">Quinta</label>
                                <input type="checkbox" name="diaSemana" id="quinta" onchange = "habilitar(id)">
                            </td>

                            <td>
                                <input type="text" id="horarioQuinta" class="input-horario" disabled>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="sexta">Sexta</label>
                                <input type="checkbox" name="diaSemana" id="sexta" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" id="horarioSexta" class="input-horario" disabled>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="sabado">Sabado</label>
                                <input type="checkbox" name="diaSemana" id="sabado" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" id="horarioSabado" class="input-horario" disabled>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="domingo">Domingo</label>
                                <input type="checkbox" name="diaSemana" id="domingo" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" id="horarioDomingo" class="input-horario" disabled>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
     
    
    </form>


    <script>

    function minhaFuncao(){

        var $radioDireta = document.getElementById('radioDireta')
        var $radioComum = document.getElementById('radioComum')

        var $destinoIntermediario = document.getElementById('destinosIntermediarios')
        var $destino2 = document.getElementById('destino2')

        if($radioDireta.checked){
            $destinoIntermediario.setAttribute("hidden","hidden")
            // $destino2.setAttribute("hidden","hidden")
        }

        if($radioComum.checked){
            $destinoIntermediario.removeAttribute("hidden")
            // $destino2.removeAttribute("hidden")

        }
        
       

    }

    //Parte Modal


    const botaoAgenda = document.getElementById('idAgenda')
    

    botaoAgenda.addEventListener('click', ()=> iniciaModalAgenda('modalAgenda'));
   
     function iniciaModalAgenda(modalID){

        const modal = document.getElementById(modalID);        
        modal.style.display = "flex"
       

        modal.addEventListener('click', (e) => {
         
            if(e.target.id == modalID || e.target.className === "botaoFechar" || e.target.className === "botaoConfirmar"){
             
               modal.style.display = "none"
               
               
            }
            console.log(e.target)
        })
        
        

     }


     //Função de Habilitar os campos


     function habilitar(idDia){

         const str = idDia 
         const textoDia = "horario"+str[0].toUpperCase() + str.substr(1)


         const dia = document.getElementById(idDia)
         const horarioDia = document.getElementById(textoDia)

        
         if(dia.checked){
            horarioDia.removeAttribute('disabled')
         }else if(!dia.checked){
            horarioDia.setAttribute('disabled','disabled')
         }



     }


    </script>

@endsection