<div class="crm-block crm-form-block crm-address_format-form-block">
  {if $action eq 8}
    <div class="messages status">
      <div class="icon inform-icon"></div>
      {ts}WARNING: Deleting a address format cannot be undone.{/ts} {ts}Do you want to continue?{/ts}
    </div>
  {else}
    <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
    <table class="form-layout-compressed">
      <tr class="crm-contribution-form-block-name">
        <td class="label">{$form.country_id.label}</td>
        <td class="html-adjust">{$form.country_id.html}</td>
      </tr>
      <tr class="crm-contribution-form-block-description">
        <td class="label">{$form.format.label} {help id='label-tokens' file="CRM/Admin/Form/Preferences/Address.hlp}</td>
        <td class="html-adjust">
          <div class="helpIcon" id="helphtml">
            <input class="crm-token-selector big" data-field="format" />
            {help id="id-token-text" file="CRM/Contact/Form/Task/Email.hlp"}
          </div>
          {$form.format.html|crmAddClass:huge12}<br />
          <span class="description">{ts}Content and format for mailing labels.{/ts}</span>
        </td>
      </tr>
    </table>
  {/if}
  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="botttom"}</div>
</div>
{include file="CRM/Mailing/Form/InsertTokens.tpl"}
