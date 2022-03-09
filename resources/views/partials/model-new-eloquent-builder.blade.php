    /**
     * @@param \Illuminate\Database\Query\Builder $query
     * @@phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function newEloquentBuilder($query): \{{ $builder }}
    {
        return new \{{ $builder }}($query);
    }
