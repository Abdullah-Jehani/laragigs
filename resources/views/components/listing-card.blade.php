<!-- in here props is used to pass data from parent component to child component. -->
<!-- here we must pass prop name listing so when the parent component use the child component can pass the data to the child using the prop name listing. -->
@props(['listing'])
            <x-card>
                    <div class="flex">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}"
                            alt=""
                        />
                        <div>
                            <h3 class="text-2xl">
                                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
                            </h3>
                            <div class="tex t-xl font-bold mb-4">{{$listing->company}}</div>
                            <x-listing-tags :tagsCsv="$listing->tags" />
                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$listing->location}}
                            </div>
                        </div>
                    </div>
        </x-card>