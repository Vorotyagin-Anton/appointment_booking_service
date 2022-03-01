const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,

  devServer: {
    client: {
      webSocketURL: 'ws://localhost:8080/ws',
    },
  },
})
