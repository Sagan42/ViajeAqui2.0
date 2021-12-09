@extends('components.layoutTelaFuncionario')

@section('contentTelaFuncionario')

    
    <form action="" method="post" class="container-cadastro-linhas" onchange = "minhaFuncao()">
        <h1 class = "tituloPaginaEditarLinha">Editar de Linhas</h1>
        @csrf
        <div class="input-cidade-origem-destino">

            <label for="origem">Origem</label>
            <input type="text" value="{{$linha->origem}}" name="origem" id="origem" >

            <label for="destino">Destino</label>
            <input type="text" value="{{$linha->destino}}" name="destino" id="destino">

        </div>
        
        <div class="input-radio-linhas">
            <div>
                <label for="radioDireta">Linha Direta &nbsp &nbsp</label>
                <input type="radio" value="Direta" name="linha" id="radioDireta" placeholder="Origem">
            </div>

            <div>
                <label for="radioComum">Linha Comum&nbsp</label>
                <input type="radio" value="Comum" name="linha" id="radioComum"  placeholder="Destino">
            </div>
        </div>

        <div class="container-numero-linha">
        
            <label for="">Numero da Linha</label>
            <input type="text" value="{{$linha->num_linha}}" name="num_linha" id="numeroLinha" placeholder="Numero da Linha" class="container-linha-input">

        </div>

        <div class="container-valor-passagem">

            <label for="">Valor da Passagem</label>
            <input type="text" value="{{$linha->preco}}" name="valor" id="" placeholder="Valor da Passagem" class="container-linha-input">


        </div>
        
        <div class="container-numero-vagas">

            <label for="">Vagas</label>
            <input type="text" value="{{$linha->quantidadePassagem}}" name="vagas" id="vagas" >
            

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
                
                <input type="button" value="X" id="botaoFechar" class="botaoFechar">
                <input type="button" value="Confirmar" id="botaoConfirmar" class="botaoConfirmar">
               
               
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
                        @foreach ($agenda as $a)
                            <tr>
                                @if ($a->dia_semana=='segunda-feira')
                                    <td>
                                        <label for="segunda">Segunda</label>
                                        <input type="checkbox" name="Segunda" id="segunda" onchange = "habilitar(id)">
                                    </td>
                                    
                                    <td>
                                    <input type="text" value="{{$a->hora}}" name ="horarioSegunda" id="horarioSegunda" class="input-horario" disabled>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='terça-feira')
                            <td>
                                <label for="terca">Terca</label>
                                <input type="checkbox" name="Terca" id="terca" onchange = "habilitar(id)" >
                            </td>

                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioTerca" id="horarioTerca" class="input-horario" disabled>
                                
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='quarta-feira')
                            <td>
                                <label for="quarta">Quarta</label>
                                <input type="checkbox" name="Quarta" id="quarta" onchange = "habilitar(id)">
                            </td>

                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioQuarta" id="horarioQuarta" class="input-horario" disabled>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='quinta-feira')
                            <td>
                                <label for="quinta">Quinta</label>
                                <input type="checkbox" name="Quinta" id="quinta" onchange = "habilitar(id)">
                            </td>

                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioQuinta" id="horarioQuinta" class="input-horario" disabled>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='sexta-feira')
                            <td>
                                <label for="sexta">Sexta</label>
                                <input type="checkbox" name="Sexta" id="sexta" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioSexta" id="horarioSexta" class="input-horario" disabled>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='sábado')
                            <td>
                                <label for="sabado">Sabado</label>
                                <input type="checkbox" name="Sabado" id="sabado" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioSabado" id="horarioSabado" class="input-horario" disabled>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach ($agenda as $a)
                        <tr>
                            @if ($a->dia_semana=='domingo')
                            <td>
                                <label for="domingo">Domingo</label>
                                <input type="checkbox" name="Domingo" id="domingo" onchange = "habilitar(id)"> 
                            </td>
                            <td>
                                <input type="text" value="{{$a->hora}}" name ="horarioDomingo" id="horarioDomingo" class="input-horario" disabled>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
     
    
    </form>


    <script>

    function minhaFuncao(){

        var $radioDireta = document.getElementById('radioDireta')
        var $radioComum = document.getElementById('radioComum')
        var numeroLinha = document.getElementById('numeroLinha')

        if($radioDireta.checked){
           numeroLinha.disabled = 'true'
           numeroLinha.value = ''
       
        }

        if($radioComum.checked){
            numeroLinha.removeAttribute('disabled');
            
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