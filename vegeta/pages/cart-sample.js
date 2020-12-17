import { EmptyState, Layout, Page, DisplayText } from '@shopify/polaris';
import { ResourcePicker, TitleBar } from '@shopify/app-bridge-react';
import store from 'store-js';
import GetCollectionByProductID from '../components/ResourceList';

store.set('p_ids', null);
store.set('prod_selected', null);

class CartSample extends React.Component {
    state = { open: false };
    render() {
      const idsState = !store.get('p_ids');
      const prdState = !store.get('prod_selected');
      var message = "Votre panier est vide. Sélectionnez d'abord des produits";
      if (store.get('prod_selected') != null) {
        message = "";
      }
      return (
        <Page>
          <TitleBar
            title="Passe ta commande !"
            primaryAction={{
              content: 'Select products',
              onAction: () => this.setState({ open: true }),
            }}
          />
          <ResourcePicker
            resourceType="Product"
            showVariants={false}
            open={this.state.open}
            onSelection={(resources) => this.handleSelection(resources)}
            onCancel={() => this.setState({ open: false })}
          />
  
          <DisplayText size="large">Panier</DisplayText>
  
          {idsState ? (
            <DisplayText size="small">{message}</DisplayText>
          ) : (
            <GetCollectionByProductID />
          )}
  
        </Page >
      );
    }
    handleSelection = (resources) => {
  
      const idsFromResources = resources.selection.map((product) => product.id);
      this.setState({ open: false });
      store.set('p_ids', idsFromResources);
    };
  }
  
  export default CartSample;
  