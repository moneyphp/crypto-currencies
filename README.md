# PHP Crypto Currencies

This library provides up-to-date list of cryptocurrencies retrieved from various sources. It uses the following sources.

- [Binance](https://binance-docs.github.io/apidocs/spot/en/)
- [CoinMarketCap](https://coinmarketcap.com/api/)

Please be aware that this library solely exists to provide cryptocurrencies for [moneyphp/money](https://github.com/moneyphp/money). Using this library for other purposes is at your own risk.

## Usage

Install using composer.
```sh
composer install
```

Add environment variable for CoinMarketCap API key.
```sh
export COIN_MARKET_CAP_API_KEY=YOUR_API_KEY
```
Update currencies using composer.
```sh
composer fetch-update
```
