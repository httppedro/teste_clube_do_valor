# Teste WordPress - Clube do Valor

O teste consiste na criação de dois plugins: um para a criação de um botão que, ao ser clicado, salva a data e hora no banco de dados, e outro que pode ler esses registros.

Foram então criados `button_widget` para a criação do botão e `clicked_register` para o acesso desses registros.

## Docker
Optei pela utilização do Docker para facilitar a execução em uma máquina terceira, com um ambiente Docker já devidamente preparado para o WordPress.

## Instalação

Como mencionado anteriormente, temos a possibilidade de utilizar o Docker neste projeto. As instruções estão a seguir. No entanto, caso não tenha o Docker instalado na máquina em questão, ou opte pelo contrário, a instalação é simples. Basta colocar os dois arquivos dentro da pasta `src` para sua pasta de plugins. Em seguida, siga para os passos após a inicialização do container.

### Inicialização do Docker

*Certifique-se de ter o Docker instalado e devidamente configurado em sua máquina.*

- Inicialize seu terminal na pasta do projeto e digite:

```bash
docker-compose up --build
```

O container será inicializado a partir da imagem oficial do WordPress, na versão mais recente.

Após seus containers terem sido inicializados, precisaremos instalá-lo no WP-CLI para executarmos o segundo plugin. No mesmo terminal, execute:

```bash
docker exec -it NOME_DO_CONTAINER_WORDPRESS bash
```

O nome do container é `teste_clube_do_valor-wordpress-1`, sendo o comando, então:

```bash
docker exec -it teste_clube_do_valor-wordpress-1 bash
```

*Use o comando `docker ps` para verificar e confirmar o nome do container antes de executar, apenas por garantia.*

Pronto, agora você está dentro do container, em um terminal bash. Nele, execute os seguintes comandos:

```bash
curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

chmod +x /usr/local/bin/wp
```

O comando `curl` faz o download do arquivo "wp-cli.phar" do repositório oficial do WP-CLI no GitHub e o salva no diretório "/usr/local/bin" com o nome "wp". Este é o executável do WP-CLI.

O comando `chmod +x` está dando permissão de execução ao arquivo "wp" que você baixou, tornando-o um executável. Isso é necessário para que você possa executar o WP-CLI a partir da linha de comando.

Finalizamos a construção do container e do ambiente.

### Após a Inicialização do Docker

Agora podemos acessar o WordPress, que ficará disponível em `localhost:8080`. Faça a inicialização padrão do WordPress, crie seu usuário e senha e acesse o painel do WordPress. Os plugins `Widget button` e `Clicked Registers` estarão disponíveis na seção de plugins. Ative-os.

Com eles ativados, vá para a página em que deseja adicionar o shortcode necessário para inicializar o `Widget button`:

```
[registro_data_hora]
```

Agora, nosso botão aparecerá na página escolhida e, ao ser clicado, salvará a data e hora no banco de dados e exibirá uma mensagem de confirmação.

E podemos agora verificar se estão mesmo sendo salvos, basta que usemos o `Clicked Registers`. No mesmo terminal, execute:

```bash
wp listar-registros --allow-root
```

E serão listados todos os registros dos cliques no botão que configuramos anteriormente.








*SOLI DEO GLORIA*