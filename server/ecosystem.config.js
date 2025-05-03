module.exports = {
    apps: [
      {
        name: 'node',
        script: 'server.js',
        instances: 1,              // <--- Один процесс
        exec_mode: 'fork',         // <--- Обычный (не кластерный) режим
        watch: false,
        autorestart: true,
        max_memory_restart: '512M',
        env: {
          NODE_ENV: 'production',
          PORT: 2083
        },
        error_file: './logs/err.log',
        out_file: './logs/out.log',
        log_date_format: 'YYYY-MM-DD HH:mm:ss',
      },
    ],
  };
  