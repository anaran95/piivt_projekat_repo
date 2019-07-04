<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* Main/getLogin.html */
class __TwigTemplate_5dfbdbdf69c10bab3e7bd5c27ae1e9bbf3ea747251f7559f99dd8a6131d82e8b extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "_global/index.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("_global/index.html", "Main/getLogin.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = [])
    {
        // line 4
        echo "<div class=\"row\">
    <form action=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["BASE"] ?? null), "html", null, true);
        echo "admin/login\" method=\"POST\" class=\"col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3\">
        <div class=\"card\">
            <div class=\"card-header\">
                Prijava administratora
            </div>
            <div class=\"card-body\">
                <div class=\"form-group\">
                    <label for=\"input_username\">Korisničko ime:</label>
                    <input type=\"text\" id=\"input_username\" name=\"login_username\" required placeholder=\"Unesite svoje korisničko ime.\" class=\"form-control\">
                </div>

                <div class=\"form-group\">
                    <label for=\"input_password\">Lozinka:</label>
                    <input type=\"password\" id=\"input_password\" name=\"login_password\" required placeholder=\"Unesite svoju lozinku.\" class=\"form-control\">
                </div>
            </div>

            <div class=\"card-footer\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    Prijavi se
                </button>
            </div>
        </div>
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "Main/getLogin.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 5,  47 => 4,  44 => 3,  34 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Main/getLogin.html", "C:\\xampp\\htdocs\\PIiVT_Projekat\\views\\Main\\getLogin.html");
    }
}
