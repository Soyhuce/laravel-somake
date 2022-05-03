/* @@covers \{{ $coveredClass }}::{{ $coveredMethod }} */

it('is successful', function (): void {
    $this->{{ $verb }}Json("{{ $url }}")
        ->assertOk();
});
