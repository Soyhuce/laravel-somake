/* @@covers \{{ $covered }} */

it('is successful', function (): void {
    $this->{{ $verb }}Json("{{ $url }}")
        ->assertOk();
});
