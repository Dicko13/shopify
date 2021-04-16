@component('mail::message')
# Du nouveau sur Shopify !

Un nouveau produit vient d'etre ajouté sur votre plateforme Shopify ! 
N'hésitez pas à le consulter en cliquant sur le bouton ci-dessous : 

@component('mail::button', ['url' => url('produits')])
Voir le produit
@endcomponent

Thanks to visit Shopify for your shopping !<br><br>
{{ config('app.name') }}
@endcomponent
