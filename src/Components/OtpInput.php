<?php
namespace HasanAhani\FilamentOtpInput\Components;

use _PHPStan_11268e5ee\Nette\PhpGenerator\Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Notifications\Notification;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;

class OtpInput extends Field implements Contracts\CanBeLengthConstrained, Contracts\HasAffixActions
{
    use Concerns\CanBeAutocapitalized;
    use Concerns\CanBeAutocompleted;
    use Concerns\CanBeLengthConstrained;
    use Concerns\CanBeReadOnly;
    use Concerns\HasAffixes;
    use Concerns\HasExtraInputAttributes;
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-otp-input::components.otp-input';

    protected string | \Closure | null $action = null;
    protected bool $hasAction = false;

    protected int | \Closure | null $numberInput = 4;


    public function numberInput(int | \Closure $number = 4):static
    {
        $this->numberInput = $number;
        return $this;
    }

    public function getNumberInput():int
    {
        return $this->evaluate($this->numberInput);
    }

    public function onComplete(string | \Closure $action):static
    {
        $this->action = $action;
        $this->hasAction = true;
        return $this;
    }

    public function getActionComplete():string | Closure | null
    {
        return $this->evaluate($this->action);
    }
    public function getHasAction(): bool
    {
        return $this->hasAction;
    }

    public function callComplete()
    {
        Notification::make()
                ->title('test')
                ->send();
        if ($this->hasAction){
            $this->getActionComplete();

        }
    }
}
