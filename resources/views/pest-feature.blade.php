/* @@covers \{{ $coveredClass }}::defineMe */

it('is successful', function (): void {
    $this->get('/')
        ->assertOk();
});
