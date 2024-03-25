<div class="w-[100%] p-6 bg-white grid grid-cols-2 md:grid-cols-4 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 my-3 px-3 flex flex-row justify-around dark:text-white">
    <span class="test-center">{{__('Status')}} :@if ($booking->financial_status !== 'non payé')
        <span
            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{__('paye')}}</span>
    @else
        <span
            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">{{__('unpaid')}}
        </span>
    @endif</span>
    <span class="test-center">{{__('Duree')}} : {{ $booking->duration() }} {{__('days')}}</span>
    <span class="test-center">{{__('Ammount')}} : {{ $booking->amount() }}.00 dh</span>
    <span class="test-center">{{__('Reste')}} : {{ $booking->reste() - $booking->discount + $booking->surcharge }}.00 dh</span>
    @if ($booking->prolongationDays()>0)
        <span class="test-center">{{__('limit')}} {{__('prolongation')}} : {{ $booking->prolongationDays()+1}} {{__('days')}}</span>
    @endif
    

</div>
