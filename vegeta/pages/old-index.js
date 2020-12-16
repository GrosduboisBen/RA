import { EmptyState, Layout, Page, ResourceList } from '@shopify/polaris';
import { ResourcePicker } from '@shopify/app-bridge-react';
import store from 'store-js';

const img = 'https://cdn.shopify.com/s/files/1/0757/9955/files/empty-state.svg';

class Index extends React.Component {
  state = { open: false };
  render() {
    const emptyState = !store.get('ids');
    return (
      <Page
        primaryAction={{
          content: 'Select products',
          onAction: () => this.setState({ open: true }),
        }}
      >
        <ResourcePicker
          resourceType="Product"
          showVariants={false}
          open={this.state.open}
          onSelection={(resources) => this.handleSelection(resources)}
          onCancel={() => this.setState({ open: false })}
        />
        {emptyState ? (
          <Layout>
            <EmptyState
              heading="Change Item Name"
              action={{
                content: 'Update item',
                onAction: () => this.setState({ open: true }),
              }}
              image={img}
            >
              <p>Modify pick-up dates for locations</p>
            </EmptyState>
          </Layout>
        ) : (
            <ResourceListWithProducts/>
          )}
      </Page>
    );
  }

  handleSelection = (resources) => {
    const idsFromResources = resources.selection.map((product) => product.id);
    this.setState({ open: false });
    store.set('ids', idsFromResources);
  };
}

export default Index;

