#!/bin/bash

# Script de startup para configurar nginx en Azure con PHP

# Crear el archivo de configuración personalizado de nginx
cat > /etc/nginx/sites-available/default << 'EOF'
server {
    listen 8080;
    server_name _;
    root /home/site/wwwroot;

    # Index
    index index.php index.html index.htm;

    # Logs
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;

    # Servir archivos estáticos
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # No acceder a directorios/archivos ocultos
    location ~ /\. {
        deny all;
    }

    # Reescribir todas las rutas dinámicas a index.php
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Procesar PHP
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
EOF

# Recargar nginx
nginx -s reload

echo "Nginx configurado correctamente para enrutamiento dinámico"
