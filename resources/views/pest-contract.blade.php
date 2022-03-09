/* @@covers \{{ $coveredClass }}::defineMe */

it('respects success contract', function (): void {
    $this->get('/')
        ->assertValidContract(200);
});
