<h1 class="m-auto w-1/2 font-bold text-2xl mb-10">You Sold Some Stocks</h1>

<img src="https://www.pinclipart.com/picdir/big/117-1177063_stock-market-graph-up-png-file-stock-arrow.png"
     alt="Stock Trader App" height="200px" width="200px"/>

<h1 class="font-bold text-2xl">Statement:</h1>
<uo>
    <li>Stock: {{ $ticker }}</li>
    <li>Quantity: {{ $quantity }}</li>
    <li>Price per Stock: {{ number_format($price,2) }}$</li>
    <li>Total Price: {{ $total }}$</li>
</uo>
<br/>
<span>You sold your stocks at {{ now() }}</span>
