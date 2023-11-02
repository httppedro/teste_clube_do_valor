# Use a imagem oficial do WordPress como base
FROM wordpress:latest

RUN useradd -ms /bin/bash user
