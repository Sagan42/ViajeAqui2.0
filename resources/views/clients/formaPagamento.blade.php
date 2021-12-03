@extends('components.layoutTelasCliente')

@section('contentTelasCliente')


<div class="container-modal" id="modalFundo">
    <div class="modal">
        <button class="fechar">X</button>

        <div class="modalPix" id="modalPix">
            <h4>Codigo PIX</h4>
            <p>00020101021226740014br.gov.bcb.pix</p>
            <i class="fas fa-qrcode fa-5x"></i>
            <button class="botaoModal">Confirmar</button>

        </div>

        <div class="modalBoleto" id="modalBoleto">
            <h4>Codigo Boleto</h4>
            <p>23795346100000030003114060000006406801813000</p>
            <i class="fas fa-barcode fa-5x"></i>
           
            <button class="botaoModal">Confirmar</button>

        </div>

        <div class="modalCartao" id="modalCartao">
            <h4>Codigo Cartao</h4>
            <input type="text" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" name="Cartao" id="campoCartao" placeholder = "Digite o numero do Cartao">

            <button class="botaoModal">Confirmar</button>

        </div>



    </div>

</div>

<div class="content-selecionar-passagens">
    <h1 class="titulo color-blue-three"> Forma de Pagamento </h1>
    <div>
        <br>
        <a href="{{route('site.client.selecionarPassagens')}}" class="blue-three btnVoltar">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>
    <table class="table">
        <thead>
            <tr class="blue-one">
                <th class="th-first">Data</th>
                <th>Saida</th>
                <th>Embarque/Desembarque</th>
                <th>Tipo de Linha</th>
                <th  class="th-last">Preço</th>
            </tr>
            <tbody>
            <tr class="neutro"><td class="td-border_none"></td></tr>
            <tr>
                <td class="border td-first"><p>{{$dataSaida}}</p></td>
                <td class="border"><p>{{$horaSaida}}</p></td>
                <td class="td-rota border">
                    {{$linhaComprada->origem}}
                    <br>
                    {{$linhaComprada->destino}}
                </td>
                <td  class="border"><p>{{$linhaComprada->tipoLinha}}</p></td>
                <td  class="border td-last"><p>R${{$linhaComprada->preco}},00</p></td>
            </tr>
        </tbody>
        </thead>        
    </table>
</div>

<div class ="content-forma-pagamento">
    <a href="#" id="cartao" onclick= "modalPagamento(id)">
        <div class = "retangulo-pagamento">
            <div class ="retangulo-pagamento-interno">
                <img src="https://i.pinimg.com/originals/62/a3/f0/62a3f05f06cac1566abca1281ced0c41.png" alt="Cartão de Crédito">
            </div>
            <p>Cartão</p>
        </div>        
    
    </a>   
    
    <a href="#" id="boleto" onclick= "modalPagamento(id)"> 
           <div class = "retangulo-pagamento">
                <div class ="retangulo-pagamento-interno">
                    <img src="https://logodownload.org/wp-content/uploads/2019/09/boleto-logo.png" alt="Boleto">
                </div>
                <p>Boleto</p>            
            </div>
        
    </a> 
        
    <a href="#" id="pix" onclick= "modalPagamento(id)">
        <div class = "retangulo-pagamento">
            <div class ="retangulo-pagamento-interno">
                <img src="https://lojaterradonunca.com.br/skin/frontend/smartwave/porto_child/images/pix-icon.png" alt="PIX">
            </div>        
            <p>PIX</p>        
    
        </div>
    </a>

    <button id="btnConfirmar">Confirmar</button>

    <div class="msgConfirmacao" id="msgConfirmacao">
        <i class="fas fa-check-circle fa-3x"></i>
        <p>Pagamento Confirmado</p>
        
    </div>

</div>








<script>

    const modal =  document.getElementById("modalFundo");
    const modalCartao =  document.getElementById("modalCartao");
    const modalPix =  document.getElementById("modalPix");
    const modalBoleto =  document.getElementById("modalBoleto");

    const boleto = document.getElementById('boleto')
    const pix = document.getElementById('pix')
    const cartao = document.getElementById('cartao')
    var opcaoMarcada = false;

      function modalPagamento(id){
        
        
        
        modal.style.display = 'flex';

        modal.addEventListener('click', (e) => {
            
            if(e.target.id == "modalFundo" || e.target.className == "fechar" || e.target.className == "botaoModal"){
                //modal.classList.remove('mostrar-modal')
               modal.style.display = "none"
            }
            
        }) 

        if(id ==="boleto"){

            
            boleto.classList.add('marcado')
            pix.classList.remove('marcado')
            cartao.classList.remove('marcado')


        

            modalBoleto.style.display = "flex"

            modalPix.style.display = "none"
            modalCartao.style.display = "none"
            
            opcaoMarcada = true;

        }else if(id==="pix"){

            pix.classList.add('marcado')
            boleto.classList.remove('marcado')           
            cartao.classList.remove('marcado')

            modalPix.style.display = "flex"
            
            modalBoleto.style.display = "none"
            modalCartao.style.display = "none"

            opcaoMarcada = true;
            


        }else if(id ==="cartao"){

            cartao.classList.add('marcado')
            boleto.classList.remove('marcado')
            pix.classList.remove('marcado')

            modalCartao.style.display = "flex"

            modalPix.style.display = "none"

            modalBoleto.style.display = "none"

            opcaoMarcada = true;

        }
    

    }
  

    const botaoConfirmar = document.getElementById('btnConfirmar')
    const t = document.getElementById('msgConfirmacao')

    botaoConfirmar.addEventListener('click', function(){

       
        if(opcaoMarcada == false){
            alert('Escolha uma opção de Pagamento')
        }else if (opcaoMarcada == true){            
                    t.style.display = 'block'
                    t.classList.toggle('mostrar')
                    setTimeout(() => {
                        window.location.replace('/cliente')
                    }, 1500);
                    
                                      
              
            
        }


    })


</script>


@endsection
