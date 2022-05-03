/* @@covers \{{ $coveredClass }}::{{ $coveredMethod }} */

it('respects success contract', function (): void {
    $this->getJson("{{ $url }}")
        ->assertValidContract(200);
});
