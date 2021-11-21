<div>
    <p>Current Price:
        <span
            class="@if($quote->getPreviousPrice() <= $quote->getCurrentPrice()) text-green-500 @else text-red-500 @endif">
                                    {{ number_format($quote->getCurrentPrice(),2) }} USD
                                    </span>
    </p>
</div>
<div>
    <p>Change:
        <span class="@if($quote->getChange() > 0) text-green-500 @else text-red-500 @endif">
                                    {{ $quote->getChange() }} USD
                                </span>
    </p>
</div>
<div>
    <p>Change in Percent:
        <span class="@if($quote->getChange() > 0) text-green-500 @else text-red-500 @endif">
                                        {{ number_format($quote->getPercentChange(), 3) }}%
                                    </span>
    </p>
</div>
<div>
    <p>High Price of the Day:
        <span
            class="@if($quote->getPreviousPrice() <= $quote->getHighPrice()) text-green-500 @else text-red-500 @endif">
                                    {{ number_format($quote->getHighPrice(),2) }} USD
                                    </span>
    </p>
</div>
<div>
    <p>Low Price of the Day:
        <span
            class="@if($quote->getPreviousPrice() <= $quote->getLowPrice()) text-green-500 @else text-red-500 @endif">
                                    {{ number_format($quote->getLowPrice(), 2) }} USD
                                    </span>
    </p>
</div>
<div>
    <p>Open Price:
        <span
            class="@if($quote->getPreviousPrice() <= $quote->getOpenPrice()) text-green-500 @else text-red-500 @endif">
                                    {{ number_format($quote->getOpenPrice(),2) }} USD
                                    </span>
    </p>
</div>
<div>
    <p>Previous Price:
        {{ $quote->getPreviousPrice() }} USD
    </p>
</div>
