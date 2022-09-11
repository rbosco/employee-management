<h1>Prezado usuário,</h1>

<p>Você solicitou que um e-mail fosse enviado para redefinir sua senha. Clique no botão abaixo para concluir a redefinição da senha.</p>

<p><a href="{{env('HOST_ADMIN')}}/novasenha/{{$token}}/{{$email}}">Clique para alterar.</a></p>

<p>Se o botão não funcionar, insira o endereço abaixo no seu navegador.</p>

<h4>{{env('HOST_ADMIN')}}/novasenha/{{$token}}/{{$email}}</h4>
