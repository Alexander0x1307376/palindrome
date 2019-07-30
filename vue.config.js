module.exports = {
    devServer: {
        proxy: 'http://palindrome.loc:80'
    },
    // publicPath: '/dist',
    publicPath: process.env.NODE_ENV === 'production'
        ? '/dist/'
        : '/',
    indexPath: 'palindromeapp.html'

};