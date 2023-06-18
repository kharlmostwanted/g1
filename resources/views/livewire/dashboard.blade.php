<div>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-4">
          <h4 class="text-gray-600">
            <a href="{{ route('households.index', ['filter' => 'updated']) }}">
              Total Households with Updated Monthly Dues
            </a>
          </h4>
          <h2 class="text-end text-xl font-bold">{{ $this->householdsWithUpdatedMonthlyDues->count() }}</h2>
        </div>
        <div class="border-t p-4">
          <h4 class="text-gray-600">
            <a href="{{ route('households.index', ['filter' => 'outdated']) }}">
              Total Households with Outdated Monthly Dues
            </a>
          </h4>
          <h2 class="text-end text-xl font-bold">{{ $this->householdsWithOutdatedMonthlyDues->count() }}</h2>
        </div>
      </div>
      <div class="mt-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-4">
          <h4 class="text-gray-600">Total Collectible Monthly Dues</h4>
          <h2 class="text-end text-xl">{{ number_format($this->totalCollectibleMonthlyDues, 2) }}</h2>
        </div>
        <div class="border-t p-4">
          <h4 class="text-gray-600">Total Collected Monthly Dues</h4>
          <h2 class="text-end text-xl">{{ number_format($this->totalCollectedMonthlyDues, 2) }}</h2>
        </div>
        <div class="border-t p-4">
          <h4 class="text-gray-600">Balance:</h4>
          <h2 class="text-end text-xl font-bold text-red-700">
            {{ number_format($this->totalCollectibleMonthlyDues - $this->totalCollectedMonthlyDues, 2) }}</h2>
        </div>
      </div>
    </div>
  </div>
</div>
