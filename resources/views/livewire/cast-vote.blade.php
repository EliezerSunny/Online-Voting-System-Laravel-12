{{-- <div wire:poll.5s="checkVotingSession"> --}}

<div>


    <script>
    var exitTime = {!! json_encode($countDownTime->vote_ends_at) !!};
  </script>





    @if (count($sortedCandidates) === 0)
    
    
    <div class="grid place-items-center border border-gray-500 rounded-lg p-5">
            <div class="mb-6">
                <flux:subheading size="lg" class="mb-3">
                     Null - Position
                </flux:subheading>
                <flux:separator variant="subtle" />
            </div>



            {{-- candidates details with image --}}
    <div class="flex items-center justify-center">
 
<div class="grid grid-cols-2 gap-2">

         
            <div class=" bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    {{-- <a href="#"> --}}
        <img class="rounded-t-lg w-60 h-60 object-cover" src="{{ asset('storage/users/avatar.png') }}" alt="No Candidate Yet" title="No Candidate Yet" />
    {{-- </a> --}}
    <div class="p-5">
        {{-- <a href="#"> --}}
            <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
                No Candidate Yet
                    </h5>
        {{-- </a> --}}
        <p class="mb-3 font-sm text-gray-700 dark:text-gray-400">  Bloc: <i> Null </i> </p>
        
        <flux:radio.group wire:model="No Candidate Yet" variant="segmented" size="sm">
            <flux:radio value="No Candidate Yet" icon="bolt">Vote for Null</flux:radio>
        </flux:radio.group>

    </div>
</div>


</div>

    </div>
{{-- candidates details with image --}}





            {{-- <flux:select wire:model="selectedCandidate" class="max-w-1/2" size="sm" placeholder="Select Candidate"> --}}
                        <flux:select disabled wire:model="No Candidate Yet" class="mt-5 max-w-1/2" size="sm" placeholder="No Candidate Yet">
                
                    <flux:select.option value="No Candidate Yet"> No Candidate Yet
                    </flux:select.option>
            </flux:select>
            
        </div>
    

    @else

    

  <livewire:countdown />

  <p id="load">
    <i>
    Loading...
    </i>
  </p>


<div class="exit-vote">

      
    @foreach ($sortedCandidates as $code => $candidates)
        <div class="grid place-items-center border border-gray-500 rounded-lg p-5">
            <div class="mb-6">
                <flux:subheading size="lg" class="mb-3">
                    {{ $codeToLabel[$code] ?? 'Position' }} - Position
                </flux:subheading>
                <flux:separator variant="subtle" />
            </div>



            {{-- candidates details with image --}}
    <div class="flex items-center justify-center">
 
<div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
   
            @foreach ($candidates as $candidate)
         
            <div class=" bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    {{-- <a href="#"> --}}
        <img class="rounded-t-lg w-60 h-60 object-cover" src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->first_name }}" title="{{ $candidate->first_name }}" />
    {{-- </a> --}}
    <div class="p-5">
        {{-- <a href="#"> --}}
            <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $candidate->first_name }} {{ $candidate->last_name }}
                        {{-- @if ($candidate->other_name)
                            , {{ $candidate->other_name }}
                        @endif --}}
                    </h5>
        {{-- </a> --}}
        <p class="mb-3 font-sm text-gray-700 dark:text-gray-400">  Bloc: <i> {{ $candidate->position->party }} </i> </p>
        
        <flux:radio.group wire:model="selectedCandidates.{{ $code }}" variant="segmented" size="sm">
            <flux:radio value="{{ $candidate->id }}" icon="bolt">Vote for {{ $candidate->first_name }}</flux:radio>
        </flux:radio.group>

    </div>
</div>

        

@endforeach

</div>

    </div>
{{-- candidates details with image --}}





            {{-- <flux:select wire:model="selectedCandidate" class="max-w-1/2" size="sm" placeholder="Select Candidate"> --}}
                        <flux:select disabled wire:model="selectedCandidates.{{ $code }}" class="mt-5 max-w-1/2" size="sm" placeholder="Select Candidate">
                @foreach ($candidates as $candidate)
                    <flux:select.option value="{{ $candidate->id }}">
                        {{ $candidate->first_name }} {{ $candidate->last_name }}
                        @if ($candidate->other_name)
                            , {{ $candidate->other_name }}
                        @endif
                    </flux:select.option>
                @endforeach
            </flux:select>
            
        </div>

        <flux:separator variant="subtle" />
        <br />
    @endforeach

    


    {{-- ONE global vote button --}}
    <div class="flex justify-center mt-6">
        <flux:button icon="bolt" wire:click="vote" color="green" class="mt-2" size="sm">
            Submit All Votes
        </flux:button>
    </div>


</div>
    @endif





</div>