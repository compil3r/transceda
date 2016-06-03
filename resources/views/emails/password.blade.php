<p align="justify">
Ola, {{$user->name}}. 
</p>
<p align="justify">
Somos do Projeto Transcenda. Estamos te enviando esse e-mail por que você nos informou que havia esquecido sua senha. Para redefini-la você pode acessar nossa página de redefinição <a href="{{ url('senha/reset/'.$token) }}">clicando aqui</a>.
</p>
<p align="justify">
Caso você não consiga clicar no link pode colar essa URL diretamente no seu navegador: {{ url('senha/reset/'.$token)}}
</p>

<p align="justify">
Atendimento ao usuário<br>
<b>Projeto Transcenda</b>
</p>

<p align="center"><i>Não responda esse e-mail!</i></p>