Cenouro Responde
===============

Modulo open do site 77chan.com.

Uso:

[MODULE URL]/{_locale}/get/seed/{seed}

### seed: 
Uma string qualquer na qual vai ser usada para gerar um numero randomico com base no argumento passado. Se você usar, por exemplo: cenouroresponde.com/get/seed/QUALQUER_MERDA
ele sempre vai gerar a mesma resposta.

### locale: 
Se não passar o *_locale* ele vai responder em ingles. O argumento default é 'en'.

Exemplo: cenouroresponde.com/get/seed/QUALQUER_MERDA = "Of course not."

Exemplo: cenouroresponde.com/pt-br/get/seed/QUALQUER_MERDA = "Claro que não."




## response:

O modelo de resposta é um array em json;
##### message:
geralmente vazio, mas se der alguma merda, aqui vem o motivo
##### status:
1 se foi, 0 se deu alguma merda

##### data:
###### message: resposta do cenouro
###### image: url absoluta do busto do cenouro

[DEMO](http://77chan.com/modules/cr/get/seed/QUALQUER_MERDA)