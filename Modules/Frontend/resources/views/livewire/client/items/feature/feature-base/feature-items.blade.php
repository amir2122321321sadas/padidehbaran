<div
    x-data="{
        activeTab: '{{ $changerItems[0]->id ?? '' }}'
    }"
>
    <!-- tabs:list-container -->
    <div class="flex justify-center">
        <!-- tabs:list -->
        <ul class="inline-flex gap-2 border-b border-border">
            @foreach($changerItems as $changerItem)
            <!-- tabs:list:item -->
            <li>
                <button type="button"
                        class="flex lg:flex-col items-center justify-center relative gap-3 border-b-4 py-2 px-4"
                        x-bind:class="activeTab === '{{$changerItem->id}}' ? 'text-primary border-primary' : 'text-muted border-transparent'"
                        x-on:click="activeTab = '{{$changerItem->id}}'">
                    <!-- active icon -->
                    <span x-bind:class="activeTab === '{{$changerItem->id}}' ? 'text-primary' : 'text-muted'">
                        {!! $changerItem->icon !!}
                    </span><!-- end active icon -->

                    <span class="lg:block hidden font-semibold text-sm"
                          x-bind:class="activeTab === '{{$changerItem->id}}' ? 'md:block' : ''">{{$changerItem->title}}</span>
                </button>
            </li><!-- end tabs:list:item -->
            @endforeach
        </ul><!-- end tabs:list -->
    </div><!-- end tabs:list-container -->

    <!-- tabs:contents -->
    <div class="bg-gradient-to-b from-secondary rounded-t-3xl max-w-4xl mx-auto p-10">
        @foreach($changerItems as $changerItem)
        <!-- tabs:contents:tab -->
        <div x-show="activeTab === '{{$changerItem->id}}'">
            <div class="flex md:flex-nowrap flex-wrap items-center gap-10">
                <div class="md:w-9/12 w-full text-justify space-y-3 text-foreground">
                   {!! $changerItem->description !!}
                </div>
                <div class="md:w-3/12 w-full">
                    <div class="w-full md:h-60 h-96 rounded-3xl overflow-hidden">
                        <img src="{{Storage::url($changerItem->image)}}" loading="lazy"
                             class="w-full h-full object-cover" alt="{{$changerItem->title}}" />
                    </div>
                </div>
            </div>
        </div><!-- end tabs:contents:tab -->
        @endforeach
    </div><!-- end tabs:contents -->

</div>
