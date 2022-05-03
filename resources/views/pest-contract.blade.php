/* @@covers \{{ $coveredClass }}::{{ $coveredMethod }} */

it('respects success contract', function (): void {
    $this->{{ $verb }}Json("{{ $url }}")
        ->assertValidContract(200);
});
