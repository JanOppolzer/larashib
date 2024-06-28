<div>

    <x-searchbox models="users" />

    <x-section>

        <x-table>

            <x-slot:thead>
                <x-th>{{ __('common.name') }}</x-th>
                <x-th>{{ __('common.email') }}</x-th>
                <x-th>{{ __('common.status') }}</x-th>
                <x-th>&nbsp;</x-th>
            </x-slot:thead>

            @foreach ($users as $user)
                <x-tr>
                    <x-td>
                        <div class="font-bold">{{ $user->name }}</div>
                        <div class="text-gray-400">{{ $user->uniqueid }}</div>
                    </x-td>
                    <x-td>
                        <x-a href="mailto:{{ $user->email }}">{{ $user->email }}</x-a>
                    </x-td>
                    <x-td>
                        <div>
                            <x-pills.user-status :$user />
                        </div>
                        <div>
                            <x-pills.user-role :$user />
                        </div>
                    </x-td>
                    <x-td>
                        <x-a href="{{ route('users.show', $user) }}">{{ __('common.show') }}</x-a>
                    </x-td>
                </x-tr>
            @endforeach

        </x-table>

        <div>{{ $users->links() }}</div>

    </x-section>

</div>
