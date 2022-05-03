/* @@covers \{{ $coveredClass }}::{{ $coveredMethod }} */

it('is successful', function (): void {
    $this->getJson("{{ $url }}")
        ->assertOk();
});
