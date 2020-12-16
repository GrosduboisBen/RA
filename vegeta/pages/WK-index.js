import { EmptyState, Layout, Page, ResourceList } from '@shopify/polaris';
import { ResourcePicker } from '@shopify/app-bridge-react';
import { Redirect } from '@shopify/app-bridge/actions';
import { Context } from '@shopify/app-bridge-react';
const img = 'https://cdn.shopify.com/s/files/1/0757/9955/files/empty-state.svg';

class Index extends React.Component {
  static contextType = Context;
  state = { open: false };
  render() {
    const app = this.context;
    const redirectToProductUpdate = () => {
      const redirect = Redirect.create(app);
      redirect.dispatch(
        Redirect.Action.APP,
        '/edit-products',
      );
    };
    return (
      <Page
        primaryAction={{
          content: 'Select products',
          onAction: () => this.setState({ open: true }),
        }}
      >
        <ResourcePicker
        selectMultiple ={false}
          resourceType="Product"
          showVariants={false}
          open={this.state.open}
          onSelection={() => redirectToProductUpdate()}
          onCancel={() => this.setState({ open: false })}
        />
      </Page>
    );
  }
}


export default Index;
